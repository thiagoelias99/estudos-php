import { useContext } from 'react';
import { AppContext } from '../Contexts/AppProvider';

export const useAppContext = () => useContext(AppContext)
