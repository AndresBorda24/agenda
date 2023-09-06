import { updatePassword } from "@/profile/requests";

export default () => ({
    state: {},
    cansubmit: true,

    async update() {
        await updatePassword( this.state );
        this.cansubmit = false;
        document.getElementById("logout-form")?.submit();
    }
});
