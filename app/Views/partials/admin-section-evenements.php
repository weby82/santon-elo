
<main class="admin">
    <div class="container">
        <div class="container-inner">
            <h2>Administration - Evènements</h2>
            <section class="section-content">

            <a class="btn btn-default" href="<?php echo $this->url('admin_creation_evenements'); ?>">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Créer un évènement
            </a>

            <?php
            
            $objetEvenementsModel = new \Model\EvenementsModel;

            // findAll RETOURNE UN TABLEAU DE TABLEAU (LIGNES + COLONNES)
            // AVEC LES PARAMETRES, ON TRIE SUR LA COLONNE id EN ORDRE DECROISSANT
            $tabLigne = $objetEvenementsModel->findAll("date_event_start", "DESC");

             ?>

                <div class="retour">
                <?php echo $evenementDeleteRetour; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Titre</th>
                            <th>Lieu</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Description</th>
                            <th>Id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
           <?php 
                foreach ($tabLigne as $key => $valeur) {
                    $id          = $valeur["id"];
                    $titre       = $valeur["titre"];
                    $lieu        = $valeur["lieu"];
                    $dateStart   = $valeur["date_event_start"];
                    $dateEnd     = $valeur["date_event_end"];
                    $description = $valeur["description"];
                    $photo       = $valeur["photo"];

                    $phpDateStart = strtotime( $dateStart );
                    $dateStartLigneCourante = date( 'd-m-Y', $phpDateStart );
                    $phpDateEnd = strtotime( $dateEnd );
                    $dateEndLigneCourante = date( 'd-m-Y', $phpDateEnd );


                    $urlPhoto    = $this->assetUrl($photo);

                    $hrefSupprimer  = "?idForm=evenementDelete&id=$id";
            ?> 
                    <tr>
                        <td><img class="table-img" src="<?php echo $urlPhoto; ?>" alt="<?php echo $titre; ?>"></td>
                        <td><?php echo $titre; ?></td>
                        <td><?php echo $lieu; ?></td>
                        <td width="90px"><?php echo $dateStartLigneCourante; ?></td>
                        <td width="90px"><?php echo $dateEndLigneCourante; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $id; ?></td>
                        <td>
                            <a href="<?php echo $this->url('admin_modifier_evenement', ['id' => $id]); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="<?php echo $hrefSupprimer; ?>" title="supprimer" class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>                                                              
                                    
                    </tr>
            <?php } ?>
                </tbody>
                </table>
            </div>
            </section>
        </div>
    </div>  
</main>