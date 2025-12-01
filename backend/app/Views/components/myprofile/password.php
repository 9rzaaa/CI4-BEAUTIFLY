<h3 class="text-xl font-semibold text-[var(--garden-dark)]">Change Password</h3>

<div>
    <label class="text-sm font-semibold text-[var(--garden-brown)]">Old Password</label>
    <input type="password" name="old_password"
           class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
</div>

<div>
    <label class="text-sm font-semibold text-[var(--garden-brown)]">New Password</label>
    <input type="password" name="new_password"
           class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
</div>

<div>
    <label class="text-sm font-semibold text-[var(--garden-brown)]">Confirm New Password</label>
    <input type="password" name="confirm_password"
           class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
</div>

<!-- Save Password Button -->
<div class="text-right pt-4">
    <button type="submit" name="save_password"
            class="bg-primary text-white px-6 py-2 rounded shadow-md hover:bg-green-700 transition">
        Save Password
    </button>
</div>