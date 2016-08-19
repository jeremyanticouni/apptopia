import React from 'react'
import component from 'omniscient'
import Select from 'js/components/base/select'
import StoreSelect from 'js/components/base/store_select'
import DatePicker from 'js/components/base/date_picker'
import catOptions from 'js/components/base/cat_options'
import DataRows from 'js/components/new_releases/data_rows'
import countries from 'js/components/base/countries'

export default component('NewReleases', (state) => {
  let query = state.cursor('query')
  let result = state.cursor('result')
  let categories = catOptions(query.get('store'))

  return (
    <section>
      <div id="new-releases" className="controls">
        <div className="control">
          <StoreSelect data={query}/>
        </div>
        <div className="control">
          <Select value={query.cursor('category')} opts={categories}/>
        </div>
        <div className="control">
          <Select value={query.cursor('country')} opts={countries}/>
        </div>
        <div className="control">
          <DatePicker value={query.cursor('date')} placeholder="MM/DD/YYYY"/>
        </div>
      </div>
      <DataRows result={result}/>
    </section>
  )
})
