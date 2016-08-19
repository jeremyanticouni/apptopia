import { GooglePlayCats, iTunesConnectCats } from 'js/components/base/categories'
export default (store) =>
  store == "google_play" ? GooglePlayCats : iTunesConnectCats
