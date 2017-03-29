
<main class="admin">
    <div class="container">
        <div class="container-inner">
            <h2>Administration - Actualité</h2>
            <section class="section-content">

            <a class="btn btn-default" href="<?php echo $this->url('admin_creation_actualites'); ?>">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Créer une actualité
            </a>

            <?php
            // ON VA CHERCHER LES INFOS DEPUIS LA TABLE actualite
            $objetActualiteModel = new \Model\ActualiteModel;

            // findAll RETOURNE UN TABLEAU DE TABLEAU (LIGNES + COLONNES)
            // AVEC LES PARAMETRES, ON TRIE SUR LA COLONNE id EN ORDRE DECROISSANT
            $tabLigne = $objetActualiteModel->findAll("id", "DESC");

             ?>
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>titre</th>
                            <th>contenu</th>
                            <th>id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
           <?php 
                foreach ($tabLigne as $key => $valeur) {
                    $id             = $valeur["id"];
                    $titre          = $valeur["titre"];
                    $contenu        = $valeur["contenu"];
                    $photo          = $valeur["photo"];

                    $urlPhoto       =$this->assetUrl($photo);
            ?> 
                    <tr>
                        <td><img class="table-img" src="<?php echo $urlPhoto; ?>" alt="<?php echo $titre; ?>"></td>
                        <td><?php echo $titre; ?></td>
                        <td><?php echo $contenu; ?></td>
                        <td><?php echo $id; ?></td>
                        <td>
                            <a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="" title="supprimer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

                        </td>                                                              
                                    
                    </tr>
            <?php } ?>
                </tbody>
                </table>
            </section>
        </div>
    </div>  
    <div class="push"></div>
</main>