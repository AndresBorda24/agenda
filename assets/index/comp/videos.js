export default () => ({
    player: null,
    videoActive: null,
    idVideos: [
        { name: "Presentación", id: "dQw4w9WgXcQ" },
        { name: "Nuestro Futuro", id: "eF_xzJ6-Ow4" },
        { name: "Trámites Virtuales", id: "KEjHJXd8bpU" }
    ],

    init() {
        this.$watch('videoActive', () => {
            this.player.loadVideoById(this.videoActive)
        })

        let tag = document.createElement('script');
        tag.id = 'iframe-videos-ayuda';
        tag.src = 'https://www.youtube.com/iframe_api';

        let firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        window.onYouTubeIframeAPIReady = () => {
            this.player = new YT.Player('iframe-videos', {
                events: {
                    onReady: () => this.setVideo(this.idVideos[0].id)
                }
            });
        }
    },

    setVideo( id ) {
        this.videoActive = id;
    }
})
