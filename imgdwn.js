import fs from 'fs/promises';
import path from 'path';
import { createWriteStream } from 'fs';
import { pipeline } from 'stream/promises';

const filenames = [
  "images/bOkCpWmcAFKox42vqxdHJY3MKsRyknmrv0TZ8Eui.jpg",
  "images/9rIpOLxu3zrPkrJn5Re7mkED4J44E1EDE5LfYBvh.jpg",
  "images/T9MFAwjRYeNx9D42tWRzZKmtpbaTCE5vbK6CdKg3.jpg",
  "images/vWYGYQMpO3nmkXiiiCNCS1z5fUYf75zXamvgWIuZ.jpg",
  "images/m7aLaFV8IgZWpUV7tN9bZGMvcQ5bjjD2MURHMPVD.jpg",
  "images/v6Z1K98gIHJfVqmbsfvpc3t6MRkW9luVgs4ENfOm.png"
];

const storageDir = './storage/app/public';

async function downloadImage(url, filepath) {
  const response = await fetch(url);
  if (!response.ok) throw new Error(`Failed to fetch ${url}: ${response.statusText}`);
  await pipeline(response.body, createWriteStream(filepath));
}

async function main() {
  for (const filename of filenames) {
    const url = `https://picsum.photos/740/400`;
    const filepath = path.join(storageDir, filename);
    
    try {
      await fs.mkdir(path.dirname(filepath), { recursive: true });
      await downloadImage(url, filepath);
      console.log(`Downloaded: ${filename}`);
    } catch (error) {
      console.error(`Error downloading ${filename}:`, error.message);
    }
  }
}

main().catch(console.error);
