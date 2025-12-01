<!-- File: app/Views/components/admin/users/user_modals.php -->
<?php
/**
 * Consolidated User Modals Component
 * Combines: create_modal.php, edit_modal.php, modal_header.php, 
 *           edit_form.php, form_input.php, form_buttons.php
 */

// Helper function to render modal header
function renderModalHeader($title, $closeFunction)
{
    return "
    <div class='flex justify-between items-center bg-lime-700 p-6 rounded-t-2xl'>
        <h2 class='font-bold text-white text-2xl'>" . esc($title) . "</h2>
        <button onclick='" . esc($closeFunction) . "' 
                class='text-white hover:text-green-50 transition-colors'>
            <svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' 
                      d='M6 18L18 6M6 6l12 12'/>
            </svg>
        </button>
    </div>";
}

// Helper function to render form input
function renderFormInput($config)
{
    $type = $config['type'] ?? 'text';
    $id = $config['id'];
    $name = $config['name'];
    $label = $config['label'];
    $placeholder = $config['placeholder'] ?? '';
    $required = ($config['required'] ?? false) ? 'required' : '';

    return "
    <div>
        <label class='block mb-2 font-semibold text-green-900 text-sm'>" . esc($label) . "</label>
        <input type='" . esc($type) . "' 
               id='" . esc($id) . "' 
               name='" . esc($name) . "' 
               placeholder='" . esc($placeholder) . "' 
               {$required}
               class='px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors'>
    </div>";
}

// Helper function to render form buttons
function renderFormButtons($submitText, $cancelFunction)
{
    return "
    <div class='flex justify-center gap-3 pt-4'>
        <button type='submit'
                class='bg-lime-600 hover:bg-lime-700 shadow-lg px-8 py-3 rounded-lg font-bold text-white transition-colors duration-200'>
            " . esc($submitText) . "
        </button>
        <button type='button' 
                onclick='" . esc($cancelFunction) . "'
                class='bg-gray-500 hover:bg-gray-700 px-8 py-3 rounded-lg font-bold text-white transition-colors duration-200'>
            Cancel
        </button>
    </div>";
}
?>

<!-- CREATE USER MODAL -->
<div id="createUserModal"
    class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 p-4">
    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <?= renderModalHeader('Create New User', 'closeModal()') ?>

        <div class="p-8">
            <?php include APPPATH . 'views/test/user_create.php'; ?>
        </div>
    </div>
</div>

<!-- EDIT USER MODAL -->
<div id="editUserModal"
    class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 p-4">
    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <?= renderModalHeader('Edit User', 'closeEditModal()') ?>

        <div class="p-8">
            <form id="editUserForm" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <!-- Name Fields -->
                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <?= renderFormInput([
                        'id' => 'edit_first_name',
                        'name' => 'first_name',
                        'label' => 'First Name *',
                        'placeholder' => 'Enter first name',
                        'required' => true
                    ]) ?>

                    <?= renderFormInput([
                        'id' => 'edit_middle_name',
                        'name' => 'middle_name',
                        'label' => 'Middle Name',
                        'placeholder' => 'Enter middle name (optional)',
                        'required' => false
                    ]) ?>
                </div>

                <!-- Last Name -->
                <?= renderFormInput([
                    'id' => 'edit_last_name',
                    'name' => 'last_name',
                    'label' => 'Last Name *',
                    'placeholder' => 'Enter last name',
                    'required' => true
                ]) ?>

                <!-- Email -->
                <?= renderFormInput([
                    'id' => 'edit_email',
                    'name' => 'email',
                    'label' => 'Email *',
                    'type' => 'email',
                    'placeholder' => 'Enter email address',
                    'required' => true
                ]) ?>

                <!-- Password Fields -->
                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <?= renderFormInput([
                        'id' => 'edit_password',
                        'name' => 'password',
                        'label' => 'Password',
                        'type' => 'password',
                        'placeholder' => 'Leave blank to keep current password',
                        'required' => false
                    ]) ?>

                    <?= renderFormInput([
                        'id' => 'edit_confirm_password',
                        'name' => 'confirm_password',
                        'label' => 'Confirm Password',
                        'type' => 'password',
                        'placeholder' => 'Confirm new password',
                        'required' => false
                    ]) ?>
                </div>

                <!-- Form Buttons -->
                <?= renderFormButtons('Update User', 'closeEditModal()') ?>
            </form>
        </div>
    </div>
</div>

<!-- MODAL SCRIPTS -->
<script>
    // Create Modal Functions
    function openModal() {
        document.getElementById('createUserModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('createUserModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Edit Modal Functions
    function openEditModal(user) {
        const formAction = '<?= site_url('crud-testing/update/') ?>' + user.id;
        document.getElementById('editUserForm').action = formAction;

        document.getElementById('edit_first_name').value = user.first_name || '';
        document.getElementById('edit_middle_name').value = user.middle_name || '';
        document.getElementById('edit_last_name').value = user.last_name || '';
        document.getElementById('edit_email').value = user.email || '';
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_confirm_password').value = '';

        document.getElementById('editUserModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editUserModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('editUserForm').reset();
    }

    // Close modals when clicking outside
    document.getElementById('createUserModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    document.getElementById('editUserModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeEditModal();
        }
    });
</script>