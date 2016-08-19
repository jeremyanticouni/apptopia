import React from 'react'
import component from 'omniscient'
import Select from 'react-select'

function renderOption (option) {
  let cssClass = option.submenu ? "submenu" : ""
  return <span className={cssClass}>{option.label}</span>
}

export default component('Select', ({value, opts}) => {
  function updateVal (val) {
    value.update(() => val)
  }

  return (
    <Select ref="stateSelect"
            options={opts}
            simpleValue
            value={value.deref()}
            onChange={updateVal}
            clearable={false}
            optionRenderer={renderOption}/>
  )
})
