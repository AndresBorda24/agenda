import { getUserData, updateUser } from "@/profile/requests";

export default () => ({
    state: {},

    async init() {
        this.state = await getUserData();
    },

    async update() {
        await updateUser( this.state );
    }
})
