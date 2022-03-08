package main

import (
	"cmd/internal/osinfo"
	"fmt"
	"internal/sysinfo"
	"runtime"
)

func main() {
	fmt.Printf("# GOARCH: %s\n", runtime.GOARCH)
	fmt.Printf("# CPU: %s\n", sysinfo.CPU.Name())

	fmt.Printf("# GOOS: %s\n", runtime.GOOS)
	ver, err := osinfo.Version()
	if err != nil {
		ver = fmt.Sprintf("UNKNOWN: error determining OS version: %v", err)
	}
	fmt.Printf("# OS Version: %s\n", ver)
}
