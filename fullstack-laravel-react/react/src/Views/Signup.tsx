import { createRef, useState } from 'react'
import { useAppContext } from '../Hooks/useAppContext'
import { Link } from 'react-router-dom'
import axiosClient from '../axios-client'
import { IUser } from '../Models/User'

export default function Signup() {
    const nameRef = createRef<HTMLInputElement>()
    const emailRef = createRef<HTMLInputElement>()
    const passwordRef = createRef<HTMLInputElement>()
    const passwordConfirmationRef = createRef<HTMLInputElement>()
    const { setUser, setToken } = useAppContext()
    const [errors, setErrors] = useState(null)


    const onSubmit = (event: React.FormEvent) => {
        event.preventDefault()

        const payload = {
            name: nameRef.current?.value,
            email: emailRef.current?.value,
            password: passwordRef.current?.value,
            password_confirmation: passwordConfirmationRef.current?.value,
        }

        axiosClient.post<{ user: IUser, token: string }>('/signup', payload)
            .then(({ data }) => {
                setUser(data.user)
                setToken(data.token);
            })
            .catch(err => {
                const response = err.response;
                if (response && response.status === 422) {
                    setErrors(response.data.errors)
                }
            })
    }

    return (
        <div className="login-signup-form animated fadeInDown">
            <div className="form">
                <form onSubmit={onSubmit}>
                    <h1 className="title">Signup for Free</h1>
                    {errors &&
                        <div className="alert">
                            {Object.keys(errors).map(key => (
                                <p key={key}>{errors[key][0]}</p>
                            ))}
                        </div>
                    }
                    <input ref={nameRef} type="text" placeholder="Full Name" />
                    <input ref={emailRef} type="email" placeholder="Email Address" />
                    <input ref={passwordRef} type="password" placeholder="Password" />
                    <input ref={passwordConfirmationRef} type="password" placeholder="Repeat Password" />
                    <button className="btn btn-block">Signup</button>
                    <p className="message">Already registered? <Link to="/login">Sign In</Link></p>
                </form>
            </div>
        </div>
    )
}
