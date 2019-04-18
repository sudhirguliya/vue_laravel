export function register(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/register', credentials)
            .then((response) => {
               res(response.data);
                //this.$router.push({name: 'login' })
            })
            .catch((err) =>{
                rej(err);
            })
    })
}