<?php
namespace App\Entity\Traits;


    trait Timestampable
    {
        private $createdAt;
        private $updatedAt;


        public function getCreatedAt(): ?\DateTimeInterface
        {
            return $this->createdAt;
        }
    
        public function setCreatedAt(\DateTimeInterface $createdAt): self
        {
            $this->createdAt = $createdAt;
    
            return $this;
        }
    
        public function getUpdatedAt(): ?\DateTimeInterface
        {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(\DateTimeInterface $updatedAt): self
        {
            $this->updatedAt = $updatedAt;
    
            return $this;
        }
    

 

        public function updateTimestamps()
        {
            if ($this->getCreatedAt() == null) {

            $this->setCreatedAt(new \DateTimeImmutable);
            }
            
            $this->setUpdatedAt(new \DateTimeImmutable);
        }

    }

