<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_client", type="string", length=45, nullable=false)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_client", type="string", length=45, nullable=false)
     */
    private $prenomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=50, nullable=false)
     * @var string The hashed password
     */
    private $motDePasse;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_client", type="string", length=50, nullable=false, unique=true)
     */
    private $mail_client;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_rue_client", type="string", length=45, nullable=false)
     */
    private $libRueClient;

    /**
     * @var string
     *
     * @ORM\Column(name="CP_client", type="string", length=45, nullable=false)
     */
    private $cpClient;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_client", type="string", length=45, nullable=false)
     */
    private $villeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_client", type="string", length=45, nullable=false)
     */
    private $telClient;

    /**
     * @var binary
     *
     * @ORM\Column(name="abonnement_newsletter", type="binary", nullable=false)
     */
    private $abonnementNewsletter;

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->motDePasse;
    }

    public function setPassword(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getMailClient(): ?string
    {
        return $this->mail_client;
    }

    public function setMailClient(string $mailClient): self
    {
        $this->mail_client = $mailClient;

        return $this;
    }

    public function getLibRueClient(): ?string
    {
        return $this->libRueClient;
    }

    public function setLibRueClient(string $libRueClient): self
    {
        $this->libRueClient = $libRueClient;

        return $this;
    }

    public function getCpClient(): ?string
    {
        return $this->cpClient;
    }

    public function setCpClient(string $cpClient): self
    {
        $this->cpClient = $cpClient;

        return $this;
    }

    public function getVilleClient(): ?string
    {
        return $this->villeClient;
    }

    public function setVilleClient(string $villeClient): self
    {
        $this->villeClient = $villeClient;

        return $this;
    }

    public function getTelClient(): ?string
    {
        return $this->telClient;
    }

    public function setTelClient(string $telClient): self
    {
        $this->telClient = $telClient;

        return $this;
    }

    public function getAbonnementNewsletter()
    {
        return $this->abonnementNewsletter;
    }

    public function setAbonnementNewsletter($abonnementNewsletter): self
    {
        $this->abonnementNewsletter = $abonnementNewsletter;

        return $this;
    }

    public function getUserIdentifier(): string {
        return (string)$this->mail_client;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string {
        return (string)$this->mail_client;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): void {
        //Pas de role pour les clients
    }

    public function setRoles(array $roles): void {
        //PAs de role pour les clients
    }

    /**
     *
     * @see UserInterface
     */
    public function getSalt(): ?string {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials() {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}

