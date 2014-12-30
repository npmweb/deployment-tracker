var app = app || {};

app.Server = Backbone.Model.extend({});

app.ServerCollection = Backbone.Collection.extend({
  model: app.Server,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    }
  },
  url: function() {
    return app.baseUrl
      + '/servers'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.servers;
  }
});
