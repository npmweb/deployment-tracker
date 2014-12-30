var app = app || {};

app.EnvironmentEndpoint = Backbone.Model.extend({});

app.EnvironmentEndpointCollection = Backbone.Collection.extend({
  model: app.EnvironmentEndpoint,
  initialize: function( applicationUid, endpointUid ) {
    this.applicationUid = applicationUid;
    this.endpointUid = endpointUid;
    this.fetch({reset:true});
  },
  url: function() {
    return app.baseUrl
      + '/applications/' + this.applicationUid
      + '/endpoints/' + this.endpointUid
      + '/environment_endpoints'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.environmentendpoints;
  }
});
