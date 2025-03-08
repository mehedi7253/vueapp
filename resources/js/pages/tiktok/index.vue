<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="video-frame">
                    <video ref="videoPlayer" autoplay controls>
                        <source :src="currentVideoSrc" type="video/mp4">
                    </video>

                    <!-- Action Buttons -->
                    <div class="actions">
                        <button>&#x2665;</button> <!-- Like -->
                        <button @click="toggleComments">&#x1F4AC;</button> <!-- Comment -->
                        <button>&#x27A4;</button> <!-- Share -->
                    </div>

                    <!-- Comment Section -->
                    <div v-if="showComments" class="comment-section">
                        <h3>Comments</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            videoList: [
                "uploads/tiktok/test.mp4",
                "uploads/tiktok/test2.mp4",
                "uploads/tiktok/test3.mp4",
            ],
            videoIndex: 0,
            startY: 0,
            showComments: false
        };
    },
    computed: {
        currentVideoSrc() {
            return this.videoList[this.videoIndex];
        }
    },
    methods: {
        changeVideo(direction) {
            if (direction === "down") {
                this.videoIndex = (this.videoIndex + 1) % this.videoList.length;
            } else if (direction === "up") {
                this.videoIndex = (this.videoIndex - 1 + this.videoList.length) % this.videoList.length;
            }
            this.$nextTick(() => {
                this.$refs.videoPlayer.load();
                this.$refs.videoPlayer.play();
            });
        },
        handleWheel(event) {
            event.preventDefault();
            if (event.deltaY > 0) {
                this.changeVideo("down");
            } else {
                this.changeVideo("up");
            }
        },
        handleTouchStart(event) {
            this.startY = event.touches[0].clientY;
        },
        handleTouchEnd(event) {
            let endY = event.changedTouches[0].clientY;
            if (this.startY - endY > 50) {
                this.changeVideo("down"); // Swipe Up
            } else if (endY - this.startY > 50) {
                this.changeVideo("up"); // Swipe Down
            }
        },
        toggleComments() {
            this.showComments = !this.showComments;
        }
    },
    mounted() {
        this.$refs.videoPlayer.addEventListener("wheel", this.handleWheel, { passive: false });
        window.addEventListener("touchstart", this.handleTouchStart);
        window.addEventListener("touchend", this.handleTouchEnd);
    },
    beforeUnmount() {
        this.$refs.videoPlayer.removeEventListener("wheel", this.handleWheel);
        window.removeEventListener("touchstart", this.handleTouchStart);
        window.removeEventListener("touchend", this.handleTouchEnd);
    }
}
</script>

<style>
.video-frame {
    width: 100%;
    height: auto;
    position: relative;
    background: black;
    border-radius: 10px;
    overflow: hidden;
}
.video-frame video {
    width: 100%;
    height: 500px;
    object-fit: cover;
}
.actions {
    position: absolute;
    right: 10px;
    bottom: 80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}
.actions button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    cursor: pointer;
}
.comment-section {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 20px;
    max-height: 300px;
    overflow-y: auto;
}
</style>
