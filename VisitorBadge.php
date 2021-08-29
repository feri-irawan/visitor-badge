<?php

/**
 * Menampilkan jumlah visitor untuk website atau repository github
 * - Name : VisitorBadge
 * - Author : Feri Irawan <feriirawan.akun@gmail.com>
 * - Github : <https://github.com/feri-irawan/visitor-badge>
 * - Created at : Ahad, 15, Agustus, 2021
 */

namespace FI\Badge;

class VisitorBadge
{
  /**
   * @param String $database_path lokasi penyimpanan file (.json)
   */
  protected $error;
  public function __construct($database_path)
  {
    $this->database_path = $database_path;
    $this->setData();
  }

  /**
   * Mengecek apakah file databasenya (file .json) ada
   * Jika tidak ada maka buat filenya
   * Program ini hanya dilakukan selama filenya tidak ditemukan
   */
  protected function setData()
  {
    if (!file_exists($this->database_path)) {
      $data = [
        "title" => "Visitor Badge",
        "description" => "Database to store visitor data",
        "data" => [],
      ];

      $data = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents($this->database_path, $data);
    }
  }

  /**
   * Mendapatkan data
   * @return Array
   */
  protected function getData()
  {
    if (!file_exists($this->database_path)) {
      // Jika file datanya belum ada maka akan dibuat
      $this->setData();

      // Jika sudah ada
    } else {
      $data = json_decode(file_get_contents($this->database_path), true);
      return $data;
    }
  }

  /**
   * Untuk mengecek apakah user sudah ada sebelumnnya
   * @param String $what Apa yang akan di cek (`username` | `repository`). 
   * @return True Jika ada
   * @return False Jika tidak ada
   */
  protected function isExists($what)
  {
    $data = $this->getData()["data"];

    /**
     * Jika yang dicek adalah username
     */
    if ($what == "username") {
      if (array_key_exists($this->username, $data)) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Jika yang dicek adalah repository
     */
    elseif ($what == "repository") {
      foreach ($data[$this->username] as $row) {
        if ($row["repo"] == $this->repository) {
          return 1;
        }
      }
      return false;
    }
  }

  /**
   * Validation
   */
  protected function validation($str)
  {
    if ($str == trim($str) && strpos($str, " ") !== false || empty($str)) {
      return false;
    }
    return true;
  }

  /**
   * Set username
   * @param String $username
   */
  public function setUsername($username)
  {
    if (!$this->validation($username)) {
      $this->error[] = [
        "code" => 1,
        "message" => "Username tidak boleh mengandung spasi atau karakter kosong",
      ];

      return false;
    }

    $this->username = urlencode($username);
  }

  /**
   * Set repository
   * @param String $repository
   */
  public function setRepository($repository)
  {
    if (!$this->validation($repository)) {
      $this->error[] = [
        "code" => 2,
        "message" => "Repository tidak boleh mengandung spasi atau karakter kosong",
      ];
      return false;
    }
    $this->repository = urlencode($repository);
  }

  /**
   * Github Visistor - badge yang dibuat akan mengikuti visitor yang ada di Github insight > traffic > views
   * @param String $token - personal access token github
   */
  public function githubVisitor($token = "")
  {

    $username = $this->username;
    $repository = $this->repository;

    $url = "https://api.github.com/repos/{$username}/{$repository}/traffic/views";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Authorization: token {$token}",
      "Accept: application/vnd.github.v3+json",
      "User-Agent: {$_SERVER['HTTP_USER_AGENT']}",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $visitor = json_decode(curl_exec($curl), true);
    curl_close($curl);

    $this->githubVisitor = isset($visitor["count"]) ? $visitor["count"] : null;
  }

  /**
   * Membuat user dan repository baru jika yang dimasukan belum ada
   */
  protected function setUserAndRepository()
  {
    // Cek apakah ada error
    if (!empty($this->error)) {
      return false;
    }

    $data = $this->getData();

    $data["data"][$this->username][] = [
      "repo" => $this->repository,
      "visitor" => 0,
    ];

    $update = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($this->database_path, $update);
  }

  /**
   * Set atau Update visitor dari repository
   */
  protected function setVisitor()
  {
    // Cek apakah ada error
    if (!empty($this->error)) {
      return false;
    }

    $data = $this->getData();
    $repos = $data["data"][$this->username];

    // Cari repository
    for ($i = 0; $i < count($repos); $i++) {

      // Cari berdasarkan nama repository
      if ($repos[$i]["repo"] == $this->repository) {
        $data["data"][$this->username][$i]["visitor"] = isset($this->githubVisitor) ? $this->githubVisitor :  $repos[$i]["visitor"] + 1;

        $update = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->database_path, $update);
        break;
      }
    }
  }

  /**
   * Mendapatkan visitor dari repository
   */
  protected function getVisitor()
  {
    // Cek apakah ada error
    if (!empty($this->error)) {
      return false;
    }

    /** 
     * Cek apakah user atau repositorynya sudah ada
     * Jika belum maka buat yang baru
     */
    if (!$this->isExists("username") || !$this->isExists("repository")) {
      $this->setUserAndRepository();
    }

    /**
     * Jika user meminta visitor
     * Maka data visitor pada repo tersebut akan di update terlebih dahulu
     */
    $this->setVisitor();

    /**
     * Kemudia mereturn nilainya
     */
    $data = $this->getData();
    $repos = $data["data"][$this->username];

    foreach ($repos as $row) {
      if ($row["repo"] === $this->repository) {
        return $row["visitor"];
      }
    }
  }

  /**
   * Membuat badge
   */
  public function generateBadge($options)
  {
    $options = http_build_query($options);
    $url = "https://img.shields.io/static/v1?{$options}";
    return file_get_contents($url);
  }

  /**
   * Menampilkan badge
   * @param Array $options (optional) 
   */
  public function output($custom_options = [])
  {
    /**
     * Default optoins
     */
    $options = [
      "label" => "VISITOR",
      "color" => "#00b3ff",
      "style" => "flat-square",
      "logo" => null,
    ];

    /**
     * Mengganti default options
     * dengan custom_options
     */
    if ($custom_options !== []) {
      foreach ($custom_options as $key => $value) {
        $options[$key] = $value == "default" ? $options[$key] : $value;
      }
    }

    // Membuat message
    $options["message"] = $this->getVisitor();

    /**
     * Headers
     */
    header("Content-Type: image/svg+xml");
    header("Cache-Control: no-cache, max-age=0, no-store, s-maxage=0, proxy-revalidate");
    $expires = gmdate("D, d M Y H:i:s", strtotime("-10 minutes"));
    header("Expires: {$expires} GMT");

    /**
     * Membuat badge error
     */
    if (!empty($this->error)) {
      $options["label"] = "ERROR";

      // Jika yang error Username dan Repository
      if (count($this->error) == 2) {
        $options["message"] = "Username dan Repository tidak boleh mengandung spasi atau akarakter kosong";
        return $this->generateBadge($options);
      }

      // Jika errornya cuma 1 (Username atau Reposiotry)
      $options["message"] = $this->error[0]["message"];
      return $this->generateBadge($options);
    }

    // Jika tidak ada error (ini yang semestinya)
    return $this->generateBadge($options);
  }
}
