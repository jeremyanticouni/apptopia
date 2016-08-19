import React from 'react'
import component from 'omniscient'
import moment from 'moment'
import DatePicker from 'react-datepicker'

export default component('DatePicker', ({value, placeholder, className}) => {
  function updateVal (newVal) {
    value.update(() => newVal.format('YYYY-MM-DD'));
  }

  let date = value.deref();
  let formattedDate = date ? moment(date) : moment().subtract(1, 'days');

  return (
    <DatePicker
        dateFormat="MM/DD/YYYY"
        selected={formattedDate}
        onChange={updateVal}
        minDate={moment().subtract(7, 'days')}
        maxDate={moment().subtract(1, 'days')}/>
  )
})
