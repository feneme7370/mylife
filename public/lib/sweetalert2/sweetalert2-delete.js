function sweetalert2Delete(event, nameDispatch) {
    Swal.fire({
        title: 'Quieres eliminar el registro',
        text: "Se eliminara de forma definitiva",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#7e22ce',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar'
        }).then((result) => {
          if (result.isConfirmed) {
            // eliminar dato
            Livewire.dispatch(nameDispatch, {id : event})
          }
    })
}