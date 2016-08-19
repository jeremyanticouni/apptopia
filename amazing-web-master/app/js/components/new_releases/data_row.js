import _ from 'lodash'
import React from 'react'
import moment from 'moment'
import component from 'omniscient'

import {Sparklines, SparklinesLine, SparklinesSpots} from 'react-sparklines'

export default component('NRDataRow', ({data}) => {
  let dls_timeline = data.cursor(['downloads_timeline', 'downloads']).toJS()
  let trend = _.isArray(dls_timeline) ? dls_timeline : []

  return (
    <tr className="nr-data-row">
      <td>
        <img className="app-icon" src={data.get('icon_url')}></img>
        <a href={data.get('url')}>{data.get('name')}</a>
        <br/>
        <small>
          <a href={data.get('publisher_url')}>
            {data.get('publisher_name')}
          </a>
        </small>
      </td>
      <td>
        {moment(data.get('release_date')).format('MM/DD/YYYY')}
      </td>
      <td>
        {Math.floor(data.get('avg_downloads'))}
      </td>
      <td>
        {data.get('total_downloads')}
      </td>
      <td>
        <Sparklines data={trend} width={145} height={45}>
          <SparklinesLine color="#1c8cdc" />
          <SparklinesSpots />
        </Sparklines>
      </td>
    </tr>
  )
})
