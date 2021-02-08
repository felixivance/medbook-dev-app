
<template>
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <div class="row">
                                    <div class="col-md-10">
                                        <strong class="card-title text-light">Genders</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <button @click="openModal" type="button" class="btn btn-primary">Add Gender</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="bootstrap-data-table_length">
                                            <label> Show
                                                <select v-model="perPage" name="bootstrap-data-table_length" aria-controls="bootstrap-data-table" class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <!-- <option value="-1">All</option> -->
                                                </select>
                                                entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b-input-group>
                                            <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search"></b-form-input>
                                            <b-input-group-append>
                                                <b-button variant="dark" :disabled="!filter" @click="filter = ''">Clear</b-button>
                                            </b-input-group-append>
                                        </b-input-group>
                                        <br/>
                                        <b-button size="sm">Copy</b-button>
                                        <b-button size="sm">Excel</b-button>
                                        <b-button size="sm">CSV</b-button>
                                        <b-button size="sm">PDF</b-button>
                                    </div>
                                </div>
                                <br/>
                                <b-table bordered :items="items" :per-page="perPage" :current-page="currentPage" :fields="fields" :filter="filter" show-empty @filtered="onFiltered">
                                    <template v-slot:cell(actions)="row">
                                        <b-button class="btn btn-sm" variant="success" @click="openEditModal(row.item)">
                                            Edit
                                        </b-button>
                                        &nbsp;
                                        <b-button @click="deleteGender(row.item.id)" class="btn btn-sm" variant="danger">
                                            Delete
                                        </b-button>
                                    </template>

                                    <template v-slot:cell(#)="row">
                                        <p>{{row.index + 1}}</p>
                                    </template>
                                </b-table>
                                <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" aria-controls="my-table"></b-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 v-if="!editMode" class="modal-title" id="mediumModalLabel">Add Gender</h5>
                        <h5 v-else class="modal-title" id="mediumModalLabel">Update Gender</h5>
                    </div>
                    <form @submit.prevent="editMode ? updateGender() : addGender()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="company" class="form-control-label">Type Of Gender:</label>
                                <input required v-model="form.genderType" type="text" id="company" placeholder="Enter Gender" class="form-control" />
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button v-if="!editMode" type="submit" class="btn btn-primary">Add Gender</button>
                            <button v-else type="submit" class="btn btn-primary">Update Gender</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import $ from 'jquery';
export default {
    data() {
        return {
            fields: ['#', 'genderType','actions'],
            items: [],
            perPage: 10,
            currentPage: 1,
            filter: null,
            totalRows: 1,
            editMode: false,
            form: new Form({
                id: '',
                genderType: '',
            })
        }
    },
    computed: {
        rows() {
            return this.items.length
        }
    },
    methods: {
        onFiltered(filteredItems) {
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        openModal() {
            $('#mediumModal').modal('show');
            this.editMode = false;
        },
        openEditModal(gender) {
            $('#mediumModal').modal('show');
            this.editMode = true;
            this.form.fill(gender)
            // console.log(this.form);
        },
      async  getGenders() {
          await  axios.get('/api/genders').then(({ data }) => {
                // console.log(data)
                this.items = data.data;
                this.totalRows = this.items.length
            }).catch((error) => {
                console.log(error);
            });
        },
        addGender() {
            axios.post('/api/genders/', this.form).then(({ data }) => {
                // console.log(data);
                if (data.success) {
                    this.form.reset();
                    this.getGenders();
                    $('#mediumModal').modal('hide');
                    Swal.fire({

                        icon: 'success',
                        title: 'Gender added.',
                        showConfirmButton: true,

                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        },
        updateGenders() {
            axios.put('/api/genders/' + this.form.id, this.form).then(({ data }) => {
                // console.log(data);
                if (data.success) {
                    this.form.reset();
                    this.getGenders();
                    $('#mediumModal').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Gender updated.',
                        showConfirmButton: true,
                        timer: 1000
                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        },
        deleteHouse(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete gender!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(id);
                    axios.delete('/api/genders/' + id,).then(({ data }) => {
                        // console.log(data);
                        if (data.success) {
                            this.form.reset();
                            this.getHouses();
                            $('#mediumModal').modal('hide');
                            Swal.fire(
                                'Deleted!',
                                'Gender has been deleted.',
                                'success'
                            )
                        }
                    }).catch((error) => {
                        console.log(error);
                    });
                }
            })
        }
    },
    mounted() {
        this.getGenders();
    },
}
</script>
