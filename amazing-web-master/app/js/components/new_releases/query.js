export default (token, q) => {
  let url = "https://integrations.apptopia.com/amazing/api/new_releases"

  let auth = new Headers()
  auth.append("Authorization", token)

  let config = { method: 'GET',
                headers: auth,
                mode: 'cors',
                cache: 'default' }

  let params = `store=${q.store}&country=${q.country}&category=${q.category}&date=${q.date}`
  return fetch(`${url}?${params}`, config)
}
