<?php
require_once('DatabaseHelper.class.php');

class ArtistDB
{
    private static $baseSQL = "SELECT * FROM Artists
    ORDER BY LastName";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class PaintingDB
{
    private static $baseSQL = "SELECT PaintingID, Paintings.ArtistID, FirstName, LastName, Paintings.GalleryID, GalleryName, ImageFileName, Title, Excerpt, YearOfWork, Description, JsonAnnotations, Width, Height, CopyrightText, WikiLink, MuseumLink, Medium FROM Galleries INNER JOIN (Artists INNER JOIN Paintings ON Artists.ArtistID = Paintings.ArtistID) ON Galleries.GalleryID = Paintings.GalleryID ";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getAllForArtist($artistID)
    {
        $sql = self::$baseSQL . " WHERE Paintings.ArtistID=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($artistID)
        );
        return $statement->fetchAll();
    }

    public function getAllForGallery($galleryID)
    {
        $sql = self::$baseSQL . " WHERE Paintings.GalleryID=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($galleryID)
        );
        return $statement->fetchAll();
    }

    public function get20()
    {
        $sql = self::$baseSQL . " ORDER BY YearOfWork LIMIT 20";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            null
        );
        return $statement->fetchAll();
    }

    public function getAllByArtist()
    {
        $sql = self::$baseSQL . " ORDER BY Artist";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            null
        );
        return $statement->fetchAll();
    }

    public function getAllByYear()
    {
        $sql = self::$baseSQL . " ORDER BY YearOfWork";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            null
        );
        return $statement->fetchAll();
    }

    public function getAllByTitle()
    {
        $sql = self::$baseSQL . " ORDER BY Title";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            null
        );
        return $statement->fetchAll();
    }

    public function getPainting($paintingID)
    {
        $sql = self::$baseSQL . "WHERE PaintingID = ?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($paintingID)
        );
        return $statement->fetch();
    }
}

class GalleryDB
{

    private static $baseSQL = "SELECT GalleryID, GalleryName FROM Galleries ORDER BY GalleryName";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            null
        );
        return $statement->fetchAll();
    }
    public function getGallery($galleryID)
    {
        $sql = self::$baseSQL . "WHERE GalleryID = ?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($galleryID)
        );
        return $statement->fetch();
    }
}

class CustomerDB
{
    private static $baseSQL = "SELECT * FROM CustomerLogon";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            null
        );
        return $statement->fetchAll();
    }
    public function findCustomer($username)
    {
        $sql = self::$baseSQL . " WHERE UserName=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($username)
        );
        return $statement->fetch();
    }
}
