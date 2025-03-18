
import Swal from "sweetalert2"

export function useSwalSuccess(message){
    Swal.fire({
        toast: true,
        icon: "success",
        title: message,
        animation: false,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    })
}

export function useSwalError(message){
    Swal.fire({
        toast: true,
        icon: "error",
        title: message,
        animation: false,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    })
}

export function useSwalConfirm(message, callback){
    Swal.fire({
        html: message,
        icon: "warning",
        buttonsStyling: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        customClass: {
            confirmButton: "confirm-button",
            cancelButton: "cancel-button",
        },
    }).then((result) => {
        if (result.isConfirmed){
            callback();
        }else if (result.isDenied){
            Swal.close();
        }
    })
}
