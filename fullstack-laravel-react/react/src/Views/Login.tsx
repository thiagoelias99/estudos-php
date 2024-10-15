import { createRef, useState } from 'react'
import { useAppContext } from '../Hooks/useAppContext'
import { Link } from 'react-router-dom'
import axiosClient from '../axios-client'
import { IUser } from '../Models/User'

export default function Login() {
    const emailRef = createRef<HTMLInputElement>()
    const passwordRef = createRef<HTMLInputElement>()
    const { setUser, setToken } = useAppContext()
    const [message, setMessage] = useState<string | null>(null)

    const onSubmit = (event: React.FormEvent) => {
        event.preventDefault()

        const payload = {
            email: emailRef.current?.value,
            password: passwordRef.current?.value,
        }
        axiosClient.post<{ user: IUser, token: string }>('/login', payload)
            .then(({ data }) => {
                setUser(data.user)
                setToken(data.token);
            })
            .catch((err) => {
                const response = err.response;
                if (response && response.status === 422) {
                    setMessage(response.data.message)
                }
            })
    }


    return (
        <div className="login-signup-form animated fadeInDown">
            <div className="form">
                <form onSubmit={onSubmit}>
                    <h1 className="title">Login into your account</h1>

                    {message &&
                        <div className="alert">
                            <p>{message}</p>
                        </div>
                    }

                    <input ref={emailRef} type="email" placeholder="Email" />
                    <input ref={passwordRef} type="password" placeholder="Password" />
                    <button className="btn btn-block">Login</button>
                    <p className="message">Not registered? <Link to="/signup">Create an account</Link></p>
                </form>
            </div>
        </div>
    )
}
