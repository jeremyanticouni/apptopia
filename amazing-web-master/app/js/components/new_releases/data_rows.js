import React from 'react'
import component from 'omniscient'
import DataRow from 'js/components/new_releases/data_row'

let loading = (
  <tr>
    <td colSpan="5">
      <h2>LOADING ...</h2>
    </td>
  </tr>
)

let noData = (
  <tr>
    <td colSpan="5">
      <h2>No data ...</h2>
    </td>
  </tr>
)

function rows(data) {
  return (data.count() > 0) ? data.map((r, i) => <DataRow key={i} data={r}/>) :
                              noData
}

function loadingOrTable(result) {
  return result.get('loading') ? loading : rows(result.get('data'))
}

export default component('NRDataRows', ({result}) => {
  return (
    <section id="nr-data-rows">
      <table>
        <thead>
          <tr>
            <th className="nr-app-info">Name</th>
            <th>Released</th>
            <th>Dls/Day</th>
            <th>Dls</th>
            <th>Dls Trend</th>
          </tr>
        </thead>
        <tbody>
          {loadingOrTable(result)}
        </tbody>
      </table>
    </section>
  )
})
