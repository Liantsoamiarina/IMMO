    document.addEventListener('livewire:init', () => {
        Livewire.on('propertyCreated', (event) => {
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('createPropertyModal'));
            modal.hide();

            // Afficher un toast de succès
            // Vous pouvez ajouter votre logique de notification ici
        });
    });
let selectedImages = [];

        function togglePropertyDetails() {
            const type = document.getElementById('type').value;
            const details = document.getElementById('propertyDetails');

            if (type === 'terrain') {
                details.style.display = 'none';
            } else {
                details.style.display = 'block';
            }
        }

        function formatPrice() {
            const priceInput = document.getElementById('price');
            const priceFormatted = document.getElementById('priceFormatted');

            if (priceInput.value) {
                const formatted = new Intl.NumberFormat('fr-FR').format(priceInput.value);
                priceFormatted.textContent = `Prix formaté: ${formatted} Ar`;
            } else {
                priceFormatted.textContent = '';
            }
        }

        function previewImages(event) {
            const files = Array.from(event.target.files);
            const maxFiles = 10;
            const maxSize = 2 * 1024 * 1024; // 2MB

            selectedImages = [];

            if (files.length > maxFiles) {
                alert(`Vous ne pouvez sélectionner que ${maxFiles} images maximum.`);
                event.target.value = '';
                return;
            }

            let validFiles = [];

            files.forEach((file, index) => {
                if (file.size > maxSize) {
                    alert(`L'image "${file.name}" est trop volumineuse (max 2MB).`);
                } else if (!file.type.match('image.*')) {
                    alert(`Le fichier "${file.name}" n'est pas une image valide.`);
                } else {
                    validFiles.push(file);
                }
            });

            if (validFiles.length === 0) {
                document.getElementById('imagePreview').style.display = 'none';
                return;
            }

            selectedImages = validFiles;
            displayImagePreviews();
        }

        function displayImagePreviews() {
            const previewContainer = document.getElementById('previewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const imageCount = document.getElementById('imageCount');

            previewContainer.innerHTML = '';

            if (selectedImages.length > 0) {
                imageCount.textContent = `(${selectedImages.length}/10)`;
                imagePreview.style.display = 'block';

                selectedImages.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 col-sm-4 col-6';

                        col.innerHTML = `
                            <div class="position-relative preview-card">
                                <div class="card shadow-sm">
                                    <img src="${e.target.result}"
                                         class="card-img-top"
                                         alt="Preview ${index + 1}"
                                         style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <button type="button"
                                                class="btn btn-danger btn-sm w-100"
                                                onclick="removeImage(${index})">
                                            <i class="fas fa-trash me-1"></i>Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;

                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                imagePreview.style.display = 'none';
            }
        }

        function removeImage(index) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
                selectedImages.splice(index, 1);
                displayImagePreviews();

                // Mise à jour du input file
                const dt = new DataTransfer();
                selectedImages.forEach(file => dt.items.add(file));
                document.getElementById('images').files = dt.files;
            }
        }

        function submitForm() {
            const form = document.getElementById('propertyForm');
            const formData = new FormData(form);

            // Validation basique
            const requiredFields = ['title', 'type', 'transaction_type', 'price'];
            let isValid = true;

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }

            // Simulation de l'envoi
            const submitBtn = document.querySelector('.btn-primary.btn-lg');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Création en cours...';

            // Simulation d'une requête API
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;

                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('propertyModal'));
                modal.hide();

                // Réinitialiser le formulaire
                form.reset();
                selectedImages = [];
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('propertyDetails').style.display = 'none';
                document.getElementById('priceFormatted').textContent = '';

                // Afficher le toast de succès
                const toast = new bootstrap.Toast(document.getElementById('successToast'));
                toast.show();

                console.log('Données du formulaire:', Object.fromEntries(formData));
            }, 2000);
        }

        // Réinitialiser le formulaire quand le modal se ferme
        document.getElementById('propertyModal').addEventListener('hidden.bs.modal', function () {
            const form = document.getElementById('propertyForm');
            form.reset();
            selectedImages = [];
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('propertyDetails').style.display = 'none';
            document.getElementById('priceFormatted').textContent = '';

            // Supprimer les classes d'erreur
            form.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
        });
