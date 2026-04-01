import { readFile, writeFile } from "fs/promises";
import project from "./package.json" with { type: "json" };

const currentData = getCurrentData();
const fileName = "CHANGELOG.md";

console.log(`* ${currentData}\nCodealem v${project.version}`);

const changelogText = await getChangeLogText();
const newChangelogText = getNewChangeLogText(changelogText);

await writeFile(fileName, newChangelogText);
console.log("\nChangelog updated!");

function getCurrentData() {
	return new Date().toISOString().split("T")[0];
}

function getChangeLogText() {
	return readFile(fileName, "utf8");
}

function getNewChangeLogText(text) {
	const newBlock = `
## [${project.version}] - ${currentData}

- **Added:**
- **Changed:**
- **Fixed:**

---
`;
	const result = text.replace("<!-- NEW -->", `<!-- NEW -->${newBlock}`);
	return result;
}
