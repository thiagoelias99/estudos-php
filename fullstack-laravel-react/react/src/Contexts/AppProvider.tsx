import { createContext, PropsWithChildren, useState } from 'react'
import { IUser } from '../Models/User'

// Define the context interface
interface IAppContext {
    user?: IUser | null
    setUser?: (user: IUser | null) => void
    token?: string | null
    setToken?: (token: string | null) => void

}

// Create the context and set the default values
export const AppContext = createContext<IAppContext>({
    user: null,
    setUser: () => { },
    token: null,
    setToken: () => { }
})

// Set the display name for the context
AppContext.displayName = 'App'

// Create the context provider
export const AppProvider = ({ children }: PropsWithChildren) => {

    // Define the state
    const [user, setUser] = useState<IUser | null>({ name: 'Thiago' })
    const [token, _setToken] = useState<string | null>(localStorage.getItem('ACCESS_TOKEN'))
    // const [token, _setToken] = useState<string | null>('123')

    const setToken = (token: string | null) => {
        _setToken(token)
        if (token) {
            localStorage.setItem('ACCESS_TOKEN', token)
        } else {
            localStorage.removeItem('ACCESS_TOKEN')
        }
    }

    return (
        <AppContext.Provider
            value={{
                user,
                setUser,
                token,
                setToken
            }}
        >
            {children}
        </AppContext.Provider>
    )
}
