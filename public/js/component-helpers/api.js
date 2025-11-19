function requestDisplayTemplate(route, idParent, idRenderChild, data = null) {
  console.log(route, idParent, idRenderChild, data);
  $.ajax({
      url: route,
      method: 'GET',
      data: data,
      headers: {
          'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(html) {
          $(idParent).html(html);
          $(idRenderChild).addClass('flex').removeClass('hidden');
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