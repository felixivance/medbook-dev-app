
// Dashboard
import Dashboard from '../components/dashboardComponent';


import Patients from '../components/patientsComponent';
import Gender from '../components/genderComponent';
import Services from '../components/serviceComponent';

export default [
    {
        path:'/admin',
        redirect:'/admin/dashboard'
    },

    {
        path: '/admin/dashboard',
        component: Dashboard,
        name: 'Dashboard',
    },
    {
        path: '/admin/patients',
        component: Patients,
        name: 'Patients',
    },

    {
        path: '/admin/gender',
        component: Gender,
        name: 'Gender',
    },
    {
        path: '/admin/services',
        component: Services,
        name: 'Services',
    },

]
