/*
 * Copyright (c) 2024 Andreas Sommer <sommer@belsignum.com>, belsignum UG
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

import axios from 'axios';

document.addEventListener('DOMContentLoaded', event => {
  for (const countrySelect of document.querySelectorAll('select.powermail_country.connected-county')) {
    let powermailCountry = new PowermailCounty(countrySelect);
  }
});


class PowermailCounty {
  constructor(countrySelect) {
    this.countrySelect = countrySelect;
    this._controller();
    // remove required as controlled by country field toggle county select
    countrySelect.closest('form').querySelector('select.powermail_county').removeAttribute('required');
  }

  _controller() {
    let that = this;
    const powermailForm = that.countrySelect.closest('form');
    let countySelect = powermailForm.querySelector('select.powermail_county');
    const apiEndpoint = countySelect.dataset.asyncUri;
    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

    // init country field
    if(that.countrySelect.value)
    {
      this._requestCounties(that.countrySelect, countySelect, apiEndpoint, that);
    }

    // change country field
    that.countrySelect.addEventListener('change', event => {
      this._requestCounties(event.target, countySelect, apiEndpoint, that);
    });
  }

  _requestCounties(countrySelect, countySelect, apiEndpoint, that) {
    axios.post(apiEndpoint, {
      'tx_powermailcountry_ajax[isoCode]': countrySelect.value
    })
      .then(function (response) {
        const count = Object.keys(response.data.counties).length
        // counties found
        if (count > 0) {
          // cleanup options
          that._clearCountyOptions(countySelect);
          // show select and set required
          countySelect.closest('.powermail_fieldwrap').classList.remove('d-none');
          countySelect.setAttribute('required', 'required');
          for (const [value, label] of Object.entries(response.data.counties)) {
            // add options
            let opt = document.createElement('option');
            opt.value = value;
            opt.innerHTML = label;
            countySelect.appendChild(opt);
          }
        } else {
          // no counties => cleanup, hide and remove required
          that._clearCountyOptions(countySelect);
          countySelect.closest('.powermail_fieldwrap').classList.add('d-none');
          countySelect.removeAttribute('required');
        }
      });
  }

  _clearCountyOptions(countySelect)
  {
    let prependedOption;
    for (const option of countySelect.querySelectorAll('option')) {
      if(option.value === '' || option.value === option.innerHTML) {
        // store prepended option
        prependedOption= option;
      }
      // remove all options
      countySelect.remove(option);
    }
    // restore prepended option
    countySelect.add(prependedOption);
  }
}
