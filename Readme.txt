Test Processing Folder : Processing Data LISA untuk Test Pertama kali -

Structure Folder
	Tgl Aquisision Data_Daerah
		LA3A0_TglAquisisi_Daerah (Level 0 - Raw)
			Tif (LA3A0_TglAquisisi_Daerah)
			Metadata (.txt)
		LA3A1_TglAquisisi_Daerah (Level 1 - Processing)
			.Tif ( LA3A1_TglAquisisi_Daerah )
			.jpg ( enhanced RGB = Nir, Red, Green )
			Metadata (.txt)

Tif Level 0 LISA
	Band1234 = Blue, Red, NIR, Green
	Flip Horizontal Left-Right
	Band to Band Coregistration : Uncorected
	Geometric : Uncorected
	Radiometric : Uncorected
Tif Level 1 LISA
	Band1234 = Blue, Green, Red, NIR
	Band to Band Coregistration : Automatic
	Geometric : Manual GCP (>= 3 point)
	Radiometric : Uncorected
	