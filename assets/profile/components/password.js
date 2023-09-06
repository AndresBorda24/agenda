import { updatePassword } from "@/profile/requests";

export default () => ({
    state: {},

    async update() {
        await updatePassword( this.state );
    }
});
