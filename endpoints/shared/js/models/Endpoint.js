var app = app || {};

app.Endpoint = Backbone.Model.extend({});

app.EndpointCollection = Backbone.Collection.extend({
  model: app.Endpoint,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    } else {
      this.applicationUid = param;
    }
  },
  url: function() {
    return app.baseUrl
      + '/applications/' + this.applicationUid
      + '/endpoints'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.endpoints;
  }
});
