wp.Modula = 'undefined' === typeof (wp.Modula) ? {} : wp.Modula;
wp.Modula.models = 'undefined' === typeof (wp.Modula.models) ? {} : wp.Modula.models;
wp.Modula.views = 'undefined' === typeof (wp.Modula.views) ? {} : wp.Modula.views;
wp.Modula.modalChildViews = 'undefined' === typeof (wp.Modula.modalChildViews) ? [] : wp.Modula.modalChildViews;

var ModulaVideoModalView = Backbone.View.extend({

    /**
     * The Tag Name and Tag's Class(es)
     */
    tagName: 'div',
    className: 'setting modula-video',

    /**
     * Template
     * - The template to load inside the above tagName element
     */
    template: wp.template('modula-video'),

    /**
     * Initialize
     */
    initialize: function (args) {
        var view = this;

        this.model = args.model;
        this.isSelectize = false;

    },

    render: function () {

        var item = this.model.get('item'),
            videoURL = item.get('video_url'),
            videoThumbnail = item.get('video_thumbnail'),
            data = {
                video_url: '',
                video_thumbnail: ''
            };

        if (videoURL) {
            data['video_url'] = videoURL;
        }

        if (videoThumbnail) {
            data['video_thumbnail'] = videoThumbnail;
        }
        this.$el.html(this.template(data));

        return this;

    },

});

wp.Modula.modalChildViews.push(ModulaVideoModalView);
