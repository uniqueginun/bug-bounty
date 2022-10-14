import { Inertia } from "@inertiajs/inertia";
import { ref } from 'vue'

const processing = ref(false);
const currentItem = ref(null);
const notes = ref("");

export default function(routeName) {

    const makeAction = (action) => {
        if (!currentItem.value) return;

        if (action === "rejected" && notes.value === "") {
            alert("Notes are required in this case");
            return;
        }

        processing.value = true;

        Inertia.post(route(routeName, currentItem.value.uuid), { action, notes: notes.value }, {
            onFinish: () => {
                processing.value = false;
            },
            onSuccess: () => {
                currentItem.value = null;
                notes.value = "";
            },
        });
    };

    return {
        processing,
        makeAction,
        notes,
        currentItem
    }
}