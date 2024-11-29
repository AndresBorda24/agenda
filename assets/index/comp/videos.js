export default () => ({
    player: null,
    videoActive: null,
    idVideos: [
        { name: "Trámites Virtuales", id: "EwwlJSudIR0" },
        { name: "Presentación", id: "nL1uNFdFvqk" },
        { name: "Solicitud De Citas", id: "HsT0_93mpSM" }
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
