function requestDisplayTemplate(route, idParent, idRenderChild, data = null) {
  // route (tautan), idParent (id dari parentnya display yang dirender), idRenderChild (id dari display yang dirender)
  $.ajax({
      url: route,
      method: 'GET',
      data: data,
      headers: {
          'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(html) {
          $(idParent).html(html);
          console.log(Alpine.initTree($(idParent)[0]));
      },
  });
}

async function requestGetData(route, data = null, callback) {
  $.ajax({
      url: route,
      method: 'GET',
      data: data,
      headers: {
          'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        if(callback) callback(response);
      },
  });
}

async function requestPostData(route, data, callback, errorCallback, type = 'POST') {
  $.ajax({
    url: route,
    type: type,
    data: JSON.stringify(data),
    contentType: 'application/json',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      if(callback) callback(response)
    },
    error: function(xhr, status, error) {
      if(errorCallback) errorCallback(xhr, status, error);
    }
  });
}

window.api = {
  requestDisplayTemplate,
  requestGetData,
  requestPostData
}