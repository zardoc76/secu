function confirmUnlock() {
    const userConfirmation = confirm('Êtes-vous sûr de vouloir débloquer cet article pour 2 euros ?');
    if (userConfirmation) {
        window.location.href = 'paiement.php';
    }
}