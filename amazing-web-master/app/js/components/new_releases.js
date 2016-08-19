import 'whatwg-fetch'
import React from 'react'
import ReactDOM from 'react-dom'
import component from 'omniscient'
import immutable from 'immutable'
import immstruct from 'immstruct'
import moment from 'moment'
import Select from 'js/components/base/select'
import DatePicker from 'js/components/base/date_picker'
import query from 'js/components/new_releases/query'
import NewReleases from 'js/components/new_releases/main'

let initialQuery = {
  query: {
    date: moment().subtract(1, 'days').format('YYYY-MM-DD'),
    store: "google_play",
    country: "US",
    category: "98"
  },
  result: {
    loading: null,
    data: null
  }
}

function resetDataRows(state, isLoading, rows) {
  state.cursor(['result', 'data']).update(() => rows)
  state.cursor(['result', 'loading']).update(() => isLoading)
}

function loadData(state, token) {
  resetDataRows(state, true, null)

  query(token, state.cursor('query').toJS()).then((response) =>
    response.text().then((json) => {
      let data = JSON.parse(json).new_releases
      resetDataRows(state, false, immutable.fromJS(data))
    })
  )
}

function loadAndRenderData(current, old, state, token, container) {
  if (!old || current.get('query') != old.get('query')) {
    loadData(state, token)
  }
  ReactDOM.render(NewReleases(state.cursor()), container)
}

function init (token, selector) {
  let container = document.querySelector(selector)
  let state = immstruct(initialQuery)
  let stateChangeHandler = (current, old) =>
    loadAndRenderData(current, old, state, token, container)

  stateChangeHandler(state)
  state.on('swap', stateChangeHandler)
}

export { init }
