var app = app || {};

app.Domain = Backbone.Model.extend({});

app.DomainCollection = Backbone.Collection.extend({
  model: app.Domain,
  initialize: function( serverUid, ipAddressUid ) {
    this.serverUid = serverUid;
    this.ipAddressUid = ipAddressUid;
  },
  url: function() {
    return app.baseUrl
      + '/servers/' + this.serverUid
      + '/ip_addresses/' + this.ipAddressUid
      + '/domains'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.domains;
  }
});
