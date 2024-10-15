import { createBrowserRouter, Navigate } from 'react-router-dom';
import Login from './Views/Login';
import Signup from './Views/Signup';
import Users from './Views/Users';
import NotFound from './Views/NotFound';
import DefaultLayout from './Views/Layouts/DefaultLayout';
import GuestLayout from './Views/Layouts/GuestLayout';
import Dashboard from './Views/Dashboard';

const router = createBrowserRouter([
    {
        path: '/',
        element: <DefaultLayout />,
        children: [
            {
                path: '/',
                element: <Navigate to='/dashboard' />
            },
            {
                path: '/users',
                element: <Users />
            },
            {
                path: '/dashboard',
                element: <Dashboard />
            },
        ]
    },
    {
        path: '/',
        element: <GuestLayout />,
        children: [
            {
                path: '/login',
                element: <Login />
            },
            {
                path: '/signup',
                element: <Signup />
            },
        ]
    },
    {
        path: '*',
        element: <NotFound />
    }
]);

export default router;
