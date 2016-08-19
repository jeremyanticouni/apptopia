import React from 'react'
import component from 'omniscient'
import Select from 'react-select'
import catOptions from 'js/components/base/cat_options'
import stores from 'js/components/base/stores'

export default component('StoreSelect', ({data, opts}) => {
  let store = data.cursor('store')
  let category = data.cursor('category')
  let val = store.deref()

  function updateVal (val) {
    data.update('store', () => val)
        .update('category', () => catOptions(val)[0].value)
  }

  return (
    <Select ref="stateSelect"
            options={stores}
            simpleValue
            value={val}
            onChange={updateVal}
            clearable={false}/>
  )
})
