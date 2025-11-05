function requestDisplayTemplate(route, idParent, idRenderChild, data = null) {
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