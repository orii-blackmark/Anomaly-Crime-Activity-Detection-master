"@author: orii-blackmark"
import cv2 
import torchvision.transforms as T
import numpy as np
import torch

class ImagePreProcessing:
    def __init__(self) -> None:
        super(ImagePreProcessing, self).__init__()
        self.transforms = T.Compose([
            T.ToPILImage(),
            T.Resize((256, 256)),
            T.ToTensor(),
        ])
        self.preprocess = T.Compose([
            T.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225]),
        ]) 
        self.augumentation = T.Compose([
            T.RandomHorizontalFlip(p=0.5),
            T.RandomVerticalFlip(p=0.5),

        ])
        
        