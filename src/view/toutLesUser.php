<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./public/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
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
<body>
    
<div>
    <form action="?action=admin" method="POST">
        <button>return</button>
    </form>
</div>

<section>
    <div class="specification-layout editContent py-5">
        <div class="container">
            <?php if (isset($users) && is_array($users)): ?>
                <div class="row g-4">
                    <?php foreach ($users as $user): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow border-0 h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <!-- Nom en noir -->
                                        <h5 class="card-title text-dark"><span class="text-muted">Nom:</span> <?= htmlspecialchars($user->getName()); ?></h5>
                                        <!-- Email en gris clair -->
                                        <p class="card-title text-dark mb-3"><span class="text-muted">Email: </span> <?= htmlspecialchars($user->getEmail()); ?></p>
                                    </div>
                                    <!-- Boutons -->
                                    <div class="d-flex gap-2">
                                        <button 
                                            class="btn btn-primary w-50 mt-auto invite-btn"
                                        >
                                        Invite
                                        </button>
                                        <button 
                                            class="btn btn-danger w-50 mt-auto delete-btn"
                                        >
                                            Delete
                                        </button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center">
                    <p class="text-muted">No users available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</body>
</html>