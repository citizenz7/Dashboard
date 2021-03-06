<?php

    namespace App\Table;

    use Core\Table\Table;

    class PostTable extends Table
    {

        //définir un nom de table pour les articles
        protected $table = 'articles';

        /**
         * Récupère les derniers articles
         * @return array
         */
        public function last()
        {
            return $this->query("
                SELECT articles.id, articles.titre, articles.lieuachat, articles.adresseachat, articles.urlachat, articles.ref, articles.dateachat, articles.datefingarantie, articles.prix, articles.conseilsentretien, articles.phototicketachat, articles.manuelutilisation, categories.titre as categorie
                FROM articles
                LEFT JOIN categories ON category_id = categories.id
                ORDER BY articles.id DESC
            ");
        }

        public function lastASC()
        {
            return $this->query("
                SELECT articles.id, articles.titre, articles.lieuachat, articles.adresseachat, articles.urlachat, articles.ref, articles.dateachat, articles.datefingarantie, articles.prix, articles.conseilsentretien, articles.phototicketachat, articles.manuelutilisation, categories.titre as categorie
                FROM articles
                LEFT JOIN categories ON category_id = categories.id
                ORDER BY articles.id ASC
            ");
        }


        /**
         * Récupère les derniers articles de la catégorie demandée
         * @param $categories_id int
         * @return array
         */
        public function lastByCategory($category_id)
        {
            return $this->query(
                "
                SELECT articles.id, articles.titre, articles.lieuachat, articles.adresseachat, articles.urlachat, articles.ref, articles.dateachat, articles.datefingarantie, articles.prix, articles.conseilsentretien, articles.phototicketachat, articles.manuelutilisation, categories.titre as categorie
                FROM articles
                LEFT JOIN categories ON category_id = categories.id
                WHERE articles.category_id = ?
                ORDER BY articles.id DESC",
                [$category_id]
            );
        }


        /**
         * Récupère un article en liant la catégorie associée
         * @param $id int
         * @return App\Entity\PostEntity
         */
        public function findWitdhCategory($id)
        {
            return $this->query(
                "
                SELECT articles.id, articles.titre, articles.lieuachat, articles.adresseachat, articles.urlachat, articles.ref, articles.dateachat, articles.datefingarantie, articles.prix, articles.conseilsentretien, articles.phototicketachat, articles.manuelutilisation, categories.titre as categorie
                FROM articles
                LEFT JOIN categories ON category_id = categories.id
                WHERE articles.id = ?
                ORDER BY articles.id DESC",
                [$id],
                true
            );
        }


        /**
         * Récupère le prix des articles pour le graphique
         * @return App\Entity\PostEntity
         */
        public function prixPosts()
        {
            return $this->query("
                SELECT articles.id, articles.prix, categories.titre as categorie
                FROM articles
                LEFT JOIN categories ON category_id = categories.id
            ");
        }

    }
