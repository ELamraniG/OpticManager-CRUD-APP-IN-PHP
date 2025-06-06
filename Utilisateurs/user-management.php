<?php
require("../head.php");
require("../connexion.php");
require("../fonctions.php");

// Handle user status changes
if (isset($_POST['toggle_user'])) {
    $user_id = $_POST['user_id'];
    $current_status = $_POST['current_status'];
    $new_status = ($current_status == 1) ? 0 : 1;
    
    $update_query = "UPDATE utilisateurs SET actif = $new_status WHERE idutilisateur = $user_id";
    if (mysqli_query($con, $update_query)) {
        $message = "Statut utilisateur mis à jour avec succès.";
        $message_type = "success";
    } else {
        $message = "Erreur lors de la mise à jour du statut.";
        $message_type = "danger";
    }
}

// Get all users with their information
$r = "SELECT idutilisateur, nomutilisateur, role, nomcomplet, actif
      FROM utilisateurs 
      ORDER BY role ASC, nomutilisateur ASC";
$res = mysqli_query($con, $r);
$nbr_users = mysqli_num_rows($res);

// Count users by status
$active_users = mysqli_num_rows(mysqli_query($con, "SELECT * FROM utilisateurs WHERE actif = 1"));
$inactive_users = mysqli_num_rows(mysqli_query($con, "SELECT * FROM utilisateurs WHERE actif = 0"));

// Count users by role
$admins = mysqli_num_rows(mysqli_query($con, "SELECT * FROM utilisateurs WHERE role = 'admin'"));
$opticiens = mysqli_num_rows(mysqli_query($con, "SELECT * FROM utilisateurs WHERE role = 'opticien'"));
$assistants = mysqli_num_rows(mysqli_query($con, "SELECT * FROM utilisateurs WHERE role = 'assistant'"));
?>

<div class="container" style="margin-top: 100px;">
    <div class="entete-list">
        <h1 class="display-4">
            <i class="fas fa-users-cog"></i> Gestion des Utilisateurs
        </h1>
        <span class="nbr"><?php echo $nbr_users; ?></span>
    </div>

    <?php if (isset($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
        <i class="fas fa-info-circle"></i> <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-3">
            <a href="../Utilisateurs/utilisateurs-form-add.php" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Nouvel Utilisateur
            </a>
        </div>
        <div class="col-md-9 text-end">
            <a href="../Utilisateurs/utilisateurs-list.php" class="btn btn-primary">
                <i class="fas fa-list"></i> Liste Complète
            </a>
            <a href="../Utilisateurs/utilisateurs-print.php" class="btn btn-secondary">
                <i class="fas fa-print"></i> Imprimer
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Utilisateurs Actifs</h6>
                            <h3><?php echo $active_users; ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Utilisateurs Inactifs</h6>
                            <h3><?php echo $inactive_users; ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-times fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h6>Admins</h6>
                    <h4><?php echo $admins; ?></h4>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h6>Opticiens</h6>
                    <h4><?php echo $opticiens; ?></h4>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-secondary text-white">
                <div class="card-body text-center">
                    <h6>Assistants</h6>
                    <h4><?php echo $assistants; ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Management Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-users"></i> Gestion Rapide des Utilisateurs
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom d'utilisateur</th>
                            <th>Nom complet</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Actions Rapides</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($user = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $user['idutilisateur']; ?></td>
                            <td><strong><?php echo $user['nomutilisateur']; ?></strong></td>
                            <td><?php echo $user['nomcomplet']; ?></td>
                            <td>
                                <?php 
                                $role_colors = [
                                    'admin' => 'danger',
                                    'opticien' => 'success', 
                                    'assistant' => 'info'
                                ];
                                $color = $role_colors[$user['role']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?php echo $color; ?>">
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user['actif'] == 1): ?>
                                    <span class="badge bg-success">Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le statut de cet utilisateur?')">
                                    <input type="hidden" name="user_id" value="<?php echo $user['idutilisateur']; ?>">
                                    <input type="hidden" name="current_status" value="<?php echo $user['actif']; ?>">
                                    <button type="submit" name="toggle_user" class="btn btn-sm <?php echo $user['actif'] == 1 ? 'btn-warning' : 'btn-success'; ?>">
                                        <i class="fas <?php echo $user['actif'] == 1 ? 'fa-user-slash' : 'fa-user-check'; ?>"></i>
                                        <?php echo $user['actif'] == 1 ? 'Désactiver' : 'Activer'; ?>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="../Utilisateurs/utilisateurs-form-update.php?id=<?php echo urlencode($user['idutilisateur']); ?>" 
                                   class="btn btn-sm btn-primary" 
                                   data-bs-toggle="tooltip" 
                                   title="Modifier cet utilisateur">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt"></i> Actions Rapides
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-grid">
                                <button class="btn btn-outline-success" onclick="activateAllUsers()">
                                    <i class="fas fa-users"></i> Activer Tous
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <button class="btn btn-outline-warning" onclick="deactivateAssistants()">
                                    <i class="fas fa-user-slash"></i> Désactiver Assistants
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <a href="../Utilisateurs/utilisateurs-form-add.php" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus"></i> Nouvel Utilisateur
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function activateAllUsers() {
    if (confirm('Êtes-vous sûr de vouloir activer tous les utilisateurs?')) {
        // This would require AJAX implementation
        alert('Fonctionnalité à implémenter avec AJAX');
    }
}

function deactivateAssistants() {
    if (confirm('Êtes-vous sûr de vouloir désactiver tous les assistants?')) {
        // This would require AJAX implementation
        alert('Fonctionnalité à implémenter avec AJAX');
    }
}
</script>

<?php
mysqli_close($con);
require("../footer.php");
?>
