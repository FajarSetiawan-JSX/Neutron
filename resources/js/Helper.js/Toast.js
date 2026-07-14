import Swal from 'sweetalert2'
export function success(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#fff',
        html: `
            <div style="display:flex;align-items:flex-start;gap:12px">
                <img src="/success.png" width="32" height="32">
                <div style="display:flex;flex-direction:column">
                    <span style="
                        color:#16a34a;
                        font-weight:600;
                        margin-top:2px;
                    ">
                        ${message}
                    </span>
                </div>
            </div>
        `,

        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer
            toast.onmouseleave = Swal.resumeTimer
        }
    })
}

export function eror(status, message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#fff',
        html: `
            <div style="display:flex;align-items:flex-start;gap:12px">
                <img src="/error.jpg" width="32" height="32">

                <div style="display:flex;flex-direction:column">
                    <span style="
                        font-size:16px;
                        font-weight:700;
                        color:#B00D26;
                        text-transform:uppercase;
                    ">
                        ${status}
                    </span>

                    <span style="
                        color:#E01030;
                        font-weight:600;
                        margin-top:2px;
                    ">
                        ${message}
                    </span>
                </div>
            </div>
        `,

        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer
            toast.onmouseleave = Swal.resumeTimer
        }
    })
}
