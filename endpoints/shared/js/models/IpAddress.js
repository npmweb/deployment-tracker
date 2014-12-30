var app = app || {};

app.IpAddress = Backbone.Model.extend({});

app.IpAddressCollection = Backbone.Collection.extend({
  model: app.IpAddress,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    } else {
      this.serverUid = param;
      this.fetch({reset:true});
    }
  },
  url: function() {
    return app.baseUrl
      + '/servers/' + this.serverUid
      + '/ip_addresses'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.ipaddresses;
  }
});
