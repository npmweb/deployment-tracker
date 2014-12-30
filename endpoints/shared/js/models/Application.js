var app = app || {};

app.Application = Backbone.Model.extend({});

app.ApplicationCollection = Backbone.Collection.extend({
  model: app.Application,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    }
  },
  url: function() {
    return app.baseUrl
      + '/applications'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.applications;
  }
});
