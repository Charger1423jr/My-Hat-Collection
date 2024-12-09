CREATE TABLE Users (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    adminStatus TINYINT(1) DEFAULT 0
);

CREATE TABLE Images (
    imageAddress VARCHAR(200) PRIMARY KEY,
    width INT(255),
    height INT(255)
);
CREATE TABLE Hats (
    id INT IDENTITY(1,1) PRIMARY KEY,
    imageAddress VARCHAR(200) NOT NULL,
    name VARCHAR(100) NOT NULL,
    bio VARCHAR(255),
    details VARCHAR(255),
    year VARCHAR(4),
    price DECIMAL(5,2)
);

CREATE TABLE Posting (
    id INT IDENTITY(1,1) PRIMARY KEY,
    imageAddress VARCHAR(200) NOT NULL,
    name VARCHAR(100) NOT NULL,
    bio VARCHAR(255),
    details VARCHAR(255),
    year VARCHAR(4),
    price DECIMAL(5,2),
    FOREIGN KEY (imageAddress) REFERENCES Images(imageAddress)
);


INSERT INTO Users (username, password, adminStatus)
VALUES 
('Bobby1', 'password123', 0),
('Tommy2', 'password123', 0),
('JimmyAdmin', 'adminpassword', 1);

INSERT INTO Images (imageAddress, width, height) 
VALUES
('.\/images\/alaska.jpg', 150, 200),
('.\/images\/california.jpg', 150, 200),
('.\/images\/colorado.jpg', 150, 200),
('.\/images\/florida.jpg', 150, 200),
('.\/images\/hawaii.JPG', 150, 200),
('.\/images\/illinois.jpg', 150, 200),
('.\/images\/michigan.jpg', 150, 200),
('.\/images\/newyork.jpg', 150, 200),
('.\/images\/scarolina.jpg', 150, 200),
('.\/images\/texas.jpg', 150, 200);


INSERT INTO Hats (imageAddress, name, bio, details, year, price)
VALUES
('.\/images\/alaska.jpg', 'Alaska State', 'Acquired hat during vacation to Alaska. Bought in tourist shop in Skagway.', 'Green hat with brown felt brim. Has state name, along with a brown bear in the middle of the leather patch. At the bottom, it says "The Last Frontier", Alaskas state motto.', '2024', 25.00),
('.\/images\/california.jpg', 'California State', 'Parents acquired hat when visiting San Francisco during vacation.', 'Black and gray hat. Big cursive "Cali" on front with small ones in a checkered pattern on underside of brim. Small grizzly bear walking, representing Californias State Flag.', '2022', 30.00),
('.\/images\/colorado.jpg', 'Colorado State', 'Bought during Layover in Denver on the way to Alaska.', 'Trucker-Style hat. Front has the colors of Colorados state flag with the mountains at the bottom.', '2024', 25.00),
('.\/images\/florida.jpg', 'Back To The Future', 'Hat from the Movie "Back to the Future: Part II". Bought during vacation to Universal Studios in Orlando, Florida.', 'Reflective rainbow colors all around hat.', '2021', 50.00),
('.\/images\/hawaii.JPG', 'Hawaii State', 'Bought by Parents during vacation to Hawaii. Found in Hana.', 'Red base, "Hana", the citys name, written in cursive on the front, with the Hawaiian flag on the top of the brim.', '2021', 20.00),
('.\/images\/illinois.jpg', 'Chicago Windy City', 'Bought during a school field trip to Chicago, found at a pier shop. My second hat in my collection.', 'Beige base with black brim and accents. Leather patch that says, "Chicago The Windy City", with the city flag behind it.', '2017', 35.00),
('.\/images\/michigan.jpg', 'Lake Michigan Sunrise', 'Bought during Vacation to Michigan. Found in a Harbor town gift shop.', 'Black base with baby blue script saying, "Michigan". The Brim is a sunset over Lake Michigan.', '2018', 20.00),
('.\/images\/newyork.jpg', 'New York Designer', 'Bought at the H&M in Times Square during a vacation to New York City. My first hat to begin my collection', 'Dark gray and light gray hat. Felt Brim, with patch that says "YHH".', '2016', 35.00),
('.\/images\/scarolina.jpg', 'Coach Designer', 'Bought at Coach Outlet Store. On sale for half off. My most expensive hat in my collection.', 'Leather brim and clasp. Coach design on hat with cursive "Coach" in blue.', '2019', 120.00),
('.\/images\/texas.jpg', 'Texas State', 'Bought in Dallas Airport during layover to Cincinnati from Seattle.', 'Trucker-Style. Texas state outline on front with "Tx" in the middle. Looks older than it really is.', '2024', 25.00);
