<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Bouton Invite */
.invite-btn {
    background-color: #007bff; /* Bleu principal */
    color: white; /* Texte blanc */
    font-weight: bold;
    border: none; /* Pas de bordure */
    border-radius: 8px; /* Coins arrondis */
    transition: all 0.3s ease; /* Transition fluide */
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3); /* Ombre légère */
}

.invite-btn:hover {
    background-color: #0056b3; /* Bleu foncé au survol */
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.5); /* Ombre plus intense */
}

/* Bouton Delete */
.delete-btn {
    background-color: #dc3545; /* Rouge principal */
    color: white; /* Texte blanc */
    font-weight: bold;
    border: none; /* Pas de bordure */
    border-radius: 8px; /* Coins arrondis */
    transition: all 0.3s ease; /* Transition fluide */
    box-shadow: 0 4px 6px rgba(220, 53, 69, 0.3); /* Ombre légère */
}

.delete-btn:hover {
    background-color: #a71d2a; /* Rouge foncé au survol */
    box-shadow: 0 6px 12px rgba(220, 53, 69, 0.5); /* Ombre plus intense */
    transform: scale(1.05);
}

    </style>
</head>
<body class="bg-gray-800">

<div class="flex items-center justify-between mb-4 p-4 w-[100%]">
      <h1 class="text-3xl font-bold text-gray-500">Tout Les User</h1>
      <nav class="text-sm">
        <a href="?action=admin" class="text-blue-400 hover:underline">Home</a>
      </nav>
    </div>

<div class="overflow-x-auto">
  <table class="w-full whitespace-no-wrap">
    <thead>
      <tr
        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
      >
        <th class="px-4 py-3">Name</th>
        <th class="px-4 py-3">Email</th>
        <th class="px-4 py-3">Active</th>
        <th class="px-4 py-3">Delete</th>
      </tr>
    </thead>
    <tbody
      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
    >
    <?php if (isset($users) && is_array($users)): ?>
      <?php foreach ($users as $user): ?>
      <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3">
          <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div
              class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
            >
            <img class="object-cover w-8 h-8 rounded-full" src="<?= $user->getImage() ?>">
              <div
                class="absolute inset-0 rounded-full shadow-inner"
                aria-hidden="true"
              ></div>
            </div>
            <div>
              <p class="font-semibold"><?= htmlspecialchars($user->getName()); ?></p>
            </div>
          </div>
        </td>
        <td class="px-4 py-3 text-sm">
          <?= htmlspecialchars($user->getEmail()); ?>
        </td>
        <td class="px-4 py-3 text-xs">
          <button>
            <span
              class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
            >
              Pending
            </span>
          </button>
        </td>
        <td class="px-4 py-3 text-xs">
          <button>
            <span
              class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
            >
              Pending
            </span>
          </button>
        </td>
      </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="text-center">
        <p class="text-muted">No users available.</p>
      </div>
    <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>